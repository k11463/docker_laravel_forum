<template>
  <div class="container box p-5 d-flex justify-content-center">
    <div>
      <!-- post -->
      <div class="card post">
        <!-- card title -->
        <div class="card-title p-1 d-flex">
          <div class="left ps-3">
            <div class="d-flex align-items-center">
              <img
                class="avatar"
                width="30"
                height="30"
                src="http://t1.gstatic.com/licensed-image?q=tbn:ANd9GcQHUjk0GeJmuF_r9ztsLkCXUd1BtZrLiJPIVc_lEpBD42BxycoM1iYkod3qAFk6FzVPaon2f1q6boeHbq5gdRg"
              />
              <div class="username ms-2">
                {{ post.username }}
              </div>
            </div>
            <div class="updated">更新日期:{{ post.updated_at }}</div>
          </div>
          <div class="middle d-flex justify-content-center align-items-center">
            <div class="title">
              {{ post.title }}
            </div>
          </div>
          <div class="right d-flex flex-column align-items-center">
            <span>覺得文章怎麼樣?</span>
            <div>
              <i class="fa-solid fa-thumbs-up"></i>
              <i class="fa-solid fa-thumbs-down"></i>
            </div>
          </div>
        </div>
        <!-- card title -->
        <!-- card body -->
        <div class="card-body">
          <div
            class="btn-area d-flex justify-content-between"
            v-if="post.user_id == user.id"
          >
            <div class="btn" @click="href('post-edit')">編輯文章</div>
            <div
              class="btn"
              data-bs-toggle="modal"
              data-bs-target="#deletePostModal"
            >
              刪除文章
            </div>
            <!-- 刪除提示 -->
            <div
              class="modal fade"
              id="deletePostModal"
              tabindex="-1"
              aria-labelledby="exampleModalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">刪除文章</h5>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                    ></button>
                  </div>
                  <div class="modal-body">
                    你確定要刪除此文章嗎? 刪除後將無法復原
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                      我反悔了
                    </button>
                    <button type="button" class="btn" @click="deletePost">
                      確定
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- 刪除提示 -->
          </div>
          <div class="content p-2">
            {{ post.content }}
          </div>
        </div>
        <!-- card body -->
      </div>
      <!-- post -->
      <!-- comments -->
      <div
        class="card comments post mt-4"
        v-for="comment in comments"
        :key="comment.id"
      >
        <!-- card title -->
        <div class="card-title p-1 d-flex justify-content-between">
          <div class="left ps-3">
            <div class="d-flex align-items-center">
              <img
                class="avatar"
                width="30"
                height="30"
                src="http://t1.gstatic.com/licensed-image?q=tbn:ANd9GcQHUjk0GeJmuF_r9ztsLkCXUd1BtZrLiJPIVc_lEpBD42BxycoM1iYkod3qAFk6FzVPaon2f1q6boeHbq5gdRg"
              />
              <div class="username ms-2">
                {{ comment.poster }}
              </div>
            </div>
            <div class="updated">
              {{ comment.updated_at }}
            </div>
          </div>
        </div>
        <!-- card title -->
        <!-- card body -->
        <div class="card-body">
          <div
            class="btn-area d-flex justify-content-end"
            v-if="user.id == comment.poster_id"
          >
            <div
              class="btn"
              data-bs-toggle="modal"
              data-bs-target="#deleteReply"
            >
              刪除回覆
            </div>
            <!-- 刪除提示 -->
            <div
              class="modal fade"
              id="deleteReply"
              tabindex="-1"
              aria-labelledby="exampleModalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">刪除文章</h5>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                    ></button>
                  </div>
                  <div class="modal-body">
                    你確定要刪除此回覆嗎? 刪除後將無法復原
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                      我反悔了
                    </button>
                    <button
                      type="button"
                      class="btn"
                      @click="deleteReply(comment.id)"
                    >
                      確定
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- 刪除提示 -->
          </div>
          <div class="content p-2">
            {{ comment.content }}
          </div>
        </div>
        <!-- card body -->
      </div>
      <!-- comments -->
      <!-- reply -->
      <div class="card reply mt-4">
        <div class="card-title d-flex justify-content-center pt-3">
          回覆文章
        </div>
        <div class="card-body">
          <div>
            <textarea
              type="text"
              class="form-control"
              aria-describedby="contentErr"
              rows="10"
              v-model="replyContent"
            ></textarea>
            <div
              id="contentErr"
              style="color: red"
              class="form-text"
              v-if="contentErr != ''"
            >
              {{ contentErr }}
            </div>
          </div>
          <div class="d-flex justify-content-end pt-3">
            <button class="btn" @click="reply">送出</button>
          </div>
        </div>
      </div>
      <!-- reply -->
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    axios.get("/post/" + window.localStorage.getItem("post_id")).then((res) => {
      //   console.log(res.data);
      this.post = res.data;
    });
    axios
      .get("/check-token", {
        headers: {
          Authorization: `Bearer ${window.localStorage.getItem("token")}`,
        },
      })
      .then((res) => {
        // console.log(res.data);
        this.user = res.data;
      });
    axios
      .get("/comments/" + window.localStorage.getItem("post_id"))
      .then((res) => {
        console.log(res.data);
        this.comments = res.data;
      });
  },
  data() {
    return {
      post: [],
      user: [],
      comments: [],
      replyContent: "",
      contentErr: "",
    };
  },
  methods: {
    href(url) {
      window.location.href = url;
    },
    deletePost() {
      var config = {
        headers: {
          Authorization: `Bearer ${window.localStorage.getItem("token")}`,
        },
      };
      axios
        .delete("/post/" + this.post.id, config)
        .then((res) => {
          window.location.href = "/posts";
        })
        .catch((err) => {
          //   window.localStorage.removeItem("token");
          //   window.location.href = "/login";
        });
    },
    reply() {
      axios
        .post(
          "/comment",
          {
            content: this.replyContent,
            user_id: this.user.id,
            post_id: this.post.id,
          },
          {
            headers: {
              Authorization: `Bearer ${window.localStorage.getItem("token")}`,
            },
          }
        )
        .then((res) => {
          window.location.reload();
        })
        .catch((err) => {
          //   console.log(err.response.data.errors);
          this.contentErr = err.response.data.errors.content[0];
        });
    },
    deleteReply(id) {
      axios
        .delete("/comment/" + id, {
          headers: {
            Authorization: `Bearer ${window.localStorage.getItem("token")}`,
          },
        })
        .then((res) => {
          window.location.reload();
        });
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/singlepost.scss";
</style>
