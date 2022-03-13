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
              <div class="col center title">紙扇會員註冊</div>
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
                <button class="btn" @click="this.Signup">註冊</button>
              </div>
            </div>
            <div class="row">
              <div class="col center login_hint">
                已經有會員了? 還不快登入????
                <a href="/signin">登入</a>
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
          type: "email",
          title: "Email",
          placeholder: "請輸入電子信箱",
          value: "",
          input_label: "email",
        },
        {
          type: "text",
          title: "使用者名稱",
          placeholder: "請輸入使用者名稱",
          value: "",
          input_label: "user_name",
        },
        {
          type: "password",
          title: "密碼",
          placeholder: "請輸入密碼",
          value: "",
          input_label: "password",
        },
        {
          type: "password",
          title: "密碼確認",
          placeholder: "請再輸入一次密碼",
          value: "",
          input_label: "password_confirmation",
        },
      ],
      error_msg: "",
      alert_appear: false,
    };
  },
  methods: {
    Signup() {
      let email, user_name, password, password_confirmation;
      this.inputs.forEach((element) => {
        switch (element.input_label) {
          case "email":
            email = element.value;
            break;
          case "user_name":
            user_name = element.value;
            break;
          case "password":
            password = element.value;
            break;
          case "password_confirmation":
            password_confirmation = element.value;
            break;
        }
      });
      axios
        .post("/signup/store", {
          email: email,
          user_name: user_name,
          password: password,
          password_confirmation: password_confirmation,
        })
        .then((res) => {
          console.log(res);
          if (res.status == 201 && res.data == "create success") {
            this.$store.dispatch("ChangeToast");
            this.$router.push("/signin");
          }
        })
        .catch((err) => {
          // console.log(Object.values(err.response.data.errors)[0][0]);
          //   console.log(err.response.data);
          this.error_msg = "";
          if (err.response.status == 422) {
            this.error_msg = Object.values(err.response.data.errors)[0][0];
          }
        });
    },
    CloseAlert() {
      this.alert_appear = false;
    },
    Test() {
      this.$store.dispatch("ChangeToast");
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/signup.scss";
</style>
