<template lang="pug">
    div.card.h-100.shadow-sm.rounded-0.border-0
        div.card-header.bg-white
            v-task-input(
                without-checkbox
                :text="value.title"
                @click:append="$emit('delete:checklist', value)"
                @text:blur="titleChanges($event)"
            )

        div.card-body.overflow-auto.bg-light
            v-task-input(
                v-for="task in value.tasks"
                class="mb-3"
                :key="task.id"
                :text="task.title"
                :checked="task.completed"
                @text:blur="taskChanges(task.recreate({ title: $event }))"
                @checkbox:input="taskChanges(task.recreate({ completed: $event }))"
                @click:append="$emit('delete:task', task)"
            )

        .card-footer.bg-white.align-items-center.d-flex
            span.badge.badge-success {{ value.tasks.length }} TASKS

            button(
                class="btn btn-link text-dark text-decoration-none rounded-0 btn-sm ml-auto"
                @click="$emit('create:task')"
            ) ADD NEW
</template>

<script>
import { TaskList } from '@models';
import vTaskInput from '@components/v-task-input';

export default {
    components: {
        vTaskInput,
    },

    props: {
        value: {
            type: TaskList,
            required: true
        }
    },

    data: () => ({
        title: null
    }),

    methods: {
        taskChanges(task) {
            this.$emit('input', this.value.spliceTask(task));
        },

        titleChanges(title) {
            this.$emit('input', this.value.recreate({ title }));
        },
    },
}
</script>
