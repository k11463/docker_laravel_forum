<template>
  <div class="box">
    <div class="card">
      <div class="container" style="padding: 40px">
        <div class="row">
          <div class="col">
            <div class="row">
              <div class="col ico center">
                <img src="favicon.ico" width="40" height="40" />
              </div>
            </div>
            <div class="row">
              <div class="col center title">紙扇會員登入</div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <form>
              <div class="form-group" v-for="input in inputs" :key="input.id">
                <label :for="input.input_label" class="mt">{{
                  input.title
                }}</label>
                <input
                  :type="input.type"
                  class="form-control mt"
                  :id="input.input_label"
                  :placeholder="input.placeholder"
                  v-model="input.value"
                />
              </div>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="row" v-if="this.error_msg != ''">
              <div class="col center error_msg">
                <span>{{ this.error_msg }}</span>
              </div>
            </div>
            <div class="row">
              <div class="col center btn_signup_box">
                <button class="btn" @click="this.Login">登入</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {},
  data() {
    return {
      inputs: [
        {
          type: "text",
          title: "帳號",
          placeholder: "請輸入Email或使用者名稱",
          value: "",
          input_label: "account",
        },
        {
          type: "password",
          title: "密碼",
          placeholder: "請輸入密碼",
          value: "",
          input_label: "password",
        },
      ],
      error_msg: "",
      alert_appear: false,
    };
  },
  methods: {
    Login() {
      let account, password;
      this.inputs.forEach((element) => {
        switch (element.input_label) {
          case "account":
            account = element.value;
            break;
          case "password":
            password = element.value;
            break;
        }
      });
      axios
        .post("/login", {
          account: account,
          password: password,
        })
        .then((res) => {
          console.log(res);
          if (res.status == 200) {
            window.location.href = "/";
            window.localStorage.setItem("token", res.data.token);
            this.$store.dispatch("SetToast", {
              status: true,
              title: "系統提示",
              content: `登入成功，歡迎回來 ${res.data.username}`,
            });
          }
        })
        .catch((err) => {
          //   console.log(Object.values(err.response.data.errors)[0][0]);
          //   console.log(err.response.data);
          this.error_msg = "";
          if (err.response.status == 422) {
            this.error_msg = Object.values(err.response.data.errors)[0][0];
          } else if (err.response.status == 401) {
            this.error_msg = err.response.data;
          } else {
            this.error_msg = "發生了未知的錯誤";
          }
        });
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/login.scss";
</style>
