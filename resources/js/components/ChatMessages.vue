<template>
    <div class="scroll">
        <ul class="chat">
            <li
                class="left clearfix"
                v-for="message in messages"
                v-bind:key="message.id"
            >
                <div class="chat-body clearfix">
                    <div class="header">
                        <strong class="primary-font">
                            {{ message.user.name }}
                        </strong>
                    </div>
                    <p>
                        {{ message.message }}
                    </p>
                </div>
            </li>
        </ul>
    </div>
</template>

<style scoped></style>

<script>
export default {
    props: ["messages"]
};
</script>
