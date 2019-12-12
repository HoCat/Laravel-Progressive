<template>
    <div class="form-group">
        <div class="flex w-full items-center justify-center bg-grey-lighter">
            <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue-500 rounded-lg shadow-lg tracking-wide uppercase border border-blue-500 cursor-pointer hover:bg-blue-500 hover:text-white">
                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                </svg>
                <span class="mt-2 text-base leading-normal">Select a file</span>
                <input type='file' id="picture" ref="picture" v-on:change="uploadFile" class="hidden form-control-file" />
            </label>
        </div>
        <input type="hidden"  :value="picture.path">
        <div v-for="(item, k) in picture.path">
            <img :src="item" />
        </div>
    </div>

</template>

<script>
    export default {
        name: "FileUploadComponent",
        data () {
          return {
              picture: {
                  path: [],
                  list: []
              },
          }
        },
        methods: {
            uploadFile() {
                let formData = new FormData();
                formData.append('picture', this.$refs.picture.files[0]);
                let $that = this;
                axios.post(
                    '/form/submit',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then( (response) => {
                    $that.picture.path.push(response.data.path);
                }).catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>

<style scoped>
    div.form-group {
        margin-top: 10px;
    }
</style>
