<template lang="pug">
    .card.h-100.shadow-sm.rounded-0.border-0
        .card-header
            .row.align-items-center
                .col.mr-auto
                    v-text-input(
                        :value="value.title"
                        @blur="titleChanges($event)"
                    )
                .col-auto
                    button.btn.btn-light.btn-sm(@click="deleteGroup(value)")
                        i.fa.fa-trash-o.text-danger

        div.card-body.overflow-auto
            .mb-3(v-for="(task, index) in value.tasks" :key="task.id")
                .row.align-items-top
                    .col-auto
                        v-check-input(
                            :value="task.completed"
                            :key="`tasks_${task.id}`"
                            @input="updateTask(task.recreate({ completed: $event }))"
                        )

                    .col.mr-auto
                        v-text-input(
                            :value="task.title"
                            :crossout="task.completed"
                            @blur="updateTask(task.recreate({ title: $event }))"
                        )

                    .col-auto
                        button.btn.btn-light.btn-sm(@click="deleteTask(task)")
                            i.fa.fa-trash-o.text-danger

        .card-footer.align-items-center.d-flex.border-top-0
            span.badge.badge-primary {{ value.tasks.length }} TASKS

            button.btn.btn-link.text-dark.btn-sm.ml-auto(
                @click="createTask(value)"
            ) ADD TASK
</template>

<script>
import { Group } from '@models';
import vCheckInput from './v-check-input';
import vTextInput from './v-text-input';

export default {
    name: 'v-task-group',

    inject: [
        'deleteGroup',
        'updateGroup',
        'createTask',
        'deleteTask',
        'updateTask'
    ],

    components: {
        vTextInput,
        vCheckInput,
    },

    props: {
        value: {
            type: Group,
            required: true
        }
    },

    methods: {
        taskCompletion(index, isCompleted) {
            const task = this.value.tasks[index];

            this.value.tasks.splice(index, 1, task.recreate({
                completed: isCompleted
            }));
        },

        titleChanges(title) {
            this.updateGroup(this.value.recreate({ title }));
        },
    },
}
</script>
