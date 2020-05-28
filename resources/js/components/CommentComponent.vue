<style scoped>
    .comment-block {
        background-color: #fff;
        display: block;
        width: 100%;
        border-radius: 0.1875rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.08);
        border:2px;
        border-style:solid;
        border-color: #e2e2e2;
    }

    .bottom-comment {
        color: #acb4c2;
        font-size: 0.875rem;
    }

    .comment-date {
        float: left;
    }

    .comment-actions {
        float: right;
    }

    .comment-actions li {
        display: inline;
        cursor: pointer;
    }

    .comment-actions li.complain {
        padding-right: 0.75rem;
        border-right: 1px solid #e1e5eb;
    }

    .comment-actions li.reply {
        padding-left: 0.75rem;
        padding-right: 0.125rem;
    }

    .comment-actions li:hover {
        color: #0095ff;
    }
</style>

<template>
    <div>
        <div class="container">
            <div v-for="(comment,index) in comments" :key="index" v-model="comments">
                <div class="comment-block mb-2">
                    <div class="card">
                        <div class="card-header form-inline">
                            <div class="mr-2">
                                <img class="rounded-circle" width="45"
                                     :src="GetProfileImage()+comment.user.profile_image"
                                     alt="">
                            </div>
                            <div class="ml-2">
                                <div class="h5 m-0">@ {{comment.user.name}}</div>
                                <div class="h7 text-muted">{{ comment.user.email }}</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="comment-text">{{comment.body}}</p>
                            <div class="bottom-comment">
                                <div class="comment-date">{{ comment.created_at }}</div>
                                <ul class="comment-actions">
                                    <li v-if=" currentuser != null && comment.user.id === currentuser.id" @click="deleteComment(comment.id,index)" class="complain">Delete</li>
                                    <li v-else-if="currentuser != null && currentuser.user_type == 'admin'" @click="deleteComment(comment.id,index)" class="complain">Delete</li>
                                    <li v-else></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-dark">
                            <strong v-if="comment.likes_comment != null" class="text-xs text-gray-500" >
                                {{ comment.likes_comment }} <i class="icon fa-heart"></i>
                            </strong>
                            <strong v-else-if="comment.likes_comment === null" class="text-xs text-gray-500">
                                0 <i class="icon fa-heart"></i>
                            </strong>
                        </div>
                        <div id="likeAct" v-if="currentuser !=null">
                            <button v-on:click="LikeButton(comment.id,index)"
                                    class="button icon fa fa-heart text-blue-400">
                                like
                            </button>
                            <button v-on:click="DislikeButton(comment.id,index)"
                                    class="button icon fa fa-heart-o text-blue-400">
                                unlike
                            </button>
                        </div>
                    </div>
                </div>
            </div>

                <div class="pt-2" v-if="currentuser != null">
                    <textarea id="BodyEditor" @keyup.enter="sendComment()" class="form-control" type="text" placeholder="Comment here"
                           name="comment" v-model="newComment">
                    </textarea>
                    <button @click="sendComment()" class="button primary mt-2" style="float:right">Submit</button>
                </div>

        </div>
    </div>
</template>
<script>
    export default {
        props: ['post', 'currentuser'],
        data() {
            return {
                newComment: [],
                comments: [],
                commentLike: [],
            }
        },
        methods: {
            sendComment() {
                axios.post('/post/' + this.post.id + '/comment/submit', {
                    body: this.newComment
                }).then(response => {
                    this.comments.push({
                        id: response.data.id,
                        user: this.currentuser,
                        body: this.newComment,
                        time: this.getNow(),
                        likes_comments: this.getComment(),
                    })
                    this.newComment = '';
                })
            },
            getComment() {
                axios.get('/post/' + this.post.id + '/comment').then(response => {
                    this.comments = response.data
                })
            },
            getNow() {
                const today = new Date();
                const date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                const dateTime = date + ' ' + time;
                return dateTime;
            },
            deleteComment(commentid, index) {
                axios.post('/post/' + this.post.id + '/comment/' + commentid + '/delete');
                this.comments.splice(index, 1);
            },
            LikeButton(commentid, index) {
                axios.post('/post/' + this.post.id + '/comment/' + commentid + '/like');
                this.getComment(commentid);
                if (index) {
                    this.getComment(commentid);
                }else
                    this.getComment(commentid);
            },
            DislikeButton(commentid, index){
                axios.delete('/post/' + this.post.id + '/comment/' + commentid + '/like');
                this.getComment(commentid);
                if (index) {
                    this.getComment(commentid);
                }else
                    this.getComment(commentid);
            },
            GetProfileImage() {
                return "images/";
            },
        },
        mounted() {
            this.getComment();
        },
        created() {
            this.getComment();
        }
    }
</script>
