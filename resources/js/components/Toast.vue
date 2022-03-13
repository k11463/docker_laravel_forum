<template>
  <div class="toast" id="toast">
    <div class="toast-header">
      <strong class="me-auto">註冊成功</strong>
      <small>1分鐘內</small>
    </div>
    <div class="toast-body">帳號已建立完成</div>
  </div>
</template>

<script>
export default {
  mounted() {},
  data() {
    return {
      counter: 2,
    };
  },
  computed: {
    GetStateToast() {
      return this.$store.state.toast;
    },
  },
  watch: {
    GetStateToast(val) {
      if (val) {
        var ele = document.getElementById("toast");
        var toast = new bootstrap.Toast(ele);
        toast.show();
        this.$store.dispatch("ChangeToast");
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.toast {
  width: 300px;
  height: 88px;
  position: fixed;
  bottom: 4px;
  right: 4px;
}
</style>
