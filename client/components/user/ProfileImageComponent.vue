<template>
  <section v-if="profile" class="relative">
    <div v-if="!showUpload" class="w-36 h-36">
      <img :src="image" class="rounded-full shadow w-full object-cover h-full" alt="profile image">
    </div>
    <el-upload
      v-if="showUpload"
      ref="upload"
      class="upload-demo"
      action=""
      accept="image/jpeg,image/jpg,image/png"
      :auto-upload="false"
      :show-file-list="false"
      :on-change="onFormSubmit"
    >
      <div class="flex flex-col gap-2">
        <el-button slot="trigger" size="small" type="primary">Choose File</el-button>
      </div>
      <div slot="tip" class="el-upload__tip">jpg/png files with a size less than 500kb</div>
    </el-upload>
    <EditButton class="text-center block mx-auto" @edit="onImageEdit" />
  </section>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import { errorNotification, successNotification } from '@/helpers/notifications'

export default {
  name: 'ProfileImageComponent',

  data () {
    return {
      showUpload: false,
      file: null,
    }
  },

  computed: {
    image () {
      return this.profile.avatar.length ? this.profile.avatar : 'https://dummyimage.com/400x400/000/fff'
    },
    ...mapGetters('profile', ['profile']),
    ...mapGetters('errors', ['error']),
    ...mapGetters('messages', ['message']),
  },

  methods: {
    async onFormSubmit (file) {
      await this.uploadAvatar({
        id: this.profile.id,
        avatar: file.raw,
      })

      if (this.message) {
        successNotification(this.message)
        this.onImageEdit()
      }
      if (this.error)
        errorNotification(this.error)
    },
    onImageEdit () {
      this.showUpload = !this.showUpload
    },

    ...mapActions({
      uploadAvatar: 'avatar/upload',
    }),
  },
}
</script>
