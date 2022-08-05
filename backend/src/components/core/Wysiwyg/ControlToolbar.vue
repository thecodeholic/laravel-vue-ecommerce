<template>
  <div v-if="editor">
    <ControlButton class="mr-1"
      @click="editor.chain().focus().toggleBold().run()"
      :class="{ 'is-active': editor.isActive('bold') }">
      <strong class="text-bold">B</strong>
    </ControlButton>
    <ControlButton class="mr-1"
      @click="editor.chain().focus().toggleItalic().run()" :class="{ 'is-active': editor.isActive('italic') }">
      <em class="italic">I</em>
    </ControlButton>
    <ControlButton class="mr-1" @click="editor.chain().focus().toggleStrike().run()" :class="{ 'is-active': editor.isActive('strike') }">
      <span class="line-through">S</span>
    </ControlButton>
    <ControlButton @click="editor.chain().focus().setParagraph().run()" :class="{ 'is-active': editor.isActive('paragraph') }">
      p
    </ControlButton>
    <ControlButton @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }">
      h1
    </ControlButton>
    <ControlButton @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }">
      h2
    </ControlButton>
    <ControlButton @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }">
      h3
    </ControlButton>
    <ControlButton @click="editor.chain().focus().toggleHeading({ level: 4 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 4 }) }">
      h4
    </ControlButton>
    <ControlButton @click="editor.chain().focus().toggleHeading({ level: 5 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 5 }) }">
      h5
    </ControlButton>
    <ControlButton @click="editor.chain().focus().toggleHeading({ level: 6 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 6 }) }">
      h6
    </ControlButton>
    <ControlButton @click="editor.chain().focus().toggleBulletList().run()"
            :class="{ 'is-active': editor.isActive('bulletList') }">
      bullet list
    </ControlButton>
    <ControlButton @click="editor.chain().focus().toggleOrderedList().run()"
            :class="{ 'is-active': editor.isActive('orderedList') }">
      ordered list
    </ControlButton>
    <ControlButton @click="editor.chain().focus().toggleCodeBlock().run()"
            :class="{ 'is-active': editor.isActive('codeBlock') }">
      code block
    </ControlButton>
    <ControlButton @click="editor.chain().focus().toggleBlockquote().run()"
            :class="{ 'is-active': editor.isActive('blockquote') }">
      blockquote
    </ControlButton>
    <ControlButton @click="editor.chain().focus().setHorizontalRule().run()">
      horizontal rule
    </ControlButton>
    <ControlButton @click="editor.chain().focus().setHardBreak().run()">
      hard break
    </ControlButton>
    <ControlButton @click="editor.chain().focus().undo().run()">
      undo
    </ControlButton>
    <ControlButton @click="editor.chain().focus().redo().run()">
      redo
    </ControlButton>
  </div>
</template>

<script setup>
import {Editor} from "@tiptap/vue-3";
import ControlButton from "./ControlButton.vue";

const props = defineProps({
  editor: {
    type: Editor,
    required: true
  }
})

</script>

<style scoped>

</style>
