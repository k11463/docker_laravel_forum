<template>
  <div class="toast" id="toast">
    <div class="toast-header">
      <strong class="me-auto">{{ title }}</strong>
    </div>
    <div class="toast-body">
      {{ content }}
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    if (window.localStorage.getItem("toast_status") != null) {
      this.title = window.localStorage.getItem("toast_title");
      this.content = window.localStorage.getItem("toast_content");
      var ele = document.getElementById("toast");
      var toast = new bootstrap.Toast(ele);
      toast.show();
    }
  },
  data() {
    return {
      title: "",
      content: "",
    };
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
