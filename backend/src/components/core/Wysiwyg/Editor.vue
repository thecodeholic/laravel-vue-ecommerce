<template>
  <!--  <ControlToolbar v-if="editor" :editor="editor" />-->
  <!--  <editor-content :editor="editor"/>-->
  <VueEditor />
</template>

<script>
import {VueEditor} from "vue2-editor";

export default {
  components: {
    VueEditor
  },

  data() {
    return {
      content: "<h1>Some initial content</h1>"
    };
  }
};
</script>
