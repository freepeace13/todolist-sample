<template lang="pug">
    div
        v-navigator(:date="$route.params.date")

        v-weekdays.d-none.d-md-block(:date="$route.params.date")

        div.bg-white.py-2.text-center
            button.btn.btn-light(@click="createChecklist") Create Checklist

        .bg-light.py-5.overflow-auto(style={ height: 'calc(100vh - 217px)' })
            .container-fluid.h-100
                .row.flex-nowrap.h-100
                    .col-xl-3.col-lg-4.col-sm-6.col-sm-6.col-12(
                        v-for="(checklist, index) in checklists"
                        :key="checklist.id"
                    )
                        v-task-list(
                            :value="checklist"
                            @delete:checklist="deleteChecklist($event)"
                            @delete:task="deleteTask(checklist, $event)"
                            @create:task="createTask(checklist)"
                            @input="updateChecklist($event)"
                        )
</template>

<script>
import axios from 'axios';
import vWeekdays from '@components/v-weekdays';
import vNavigator from '@components/v-navigator';
import vTaskList from '@components/v-task-list';
import { TaskList, Task } from '@models';
import moment from 'moment';

export default {
    components: {
        vNavigator,
        vTaskList,
        vWeekdays
    },

    data: () => ({
        checklists: []
    }),

    provide() {
        return {
            jumpTo: this.jumpTo
        };
    },

    methods: {
        jumpTo(date) {
            this.$router.replace({
                name: 'tasks',
                params: { date: this.$utils.dates.urldate(date) }
            })
        },

        async createChecklist() {
            this.checklists.push(
                await TaskList.create(this.$route.params.date)
            );
        },

        async deleteChecklist(checklist) {
            await TaskList.destroy(checklist.id);
            const index = this.checklists.findIndex((v) => v.id === checklist.id);
            this.checklists.splice(index, 1);
        },

        async createTask(checklist) {
            const index = this.checklists.findIndex((v) => v.id === checklist.id);

            if (index >= 0) {
                this.checklists.splice(index, 1,
                    checklist.recreate({ tasks: [
                        ...checklist.tasks,
                        await Task.create(checklist.id)
                    ]})
                );
            }
        },

        deleteTask(checklist, task) {
            const index = checklist.tasks.findIndex((v) => v.id === task.id);

            if (index >= 0) {
                checklist.tasks.splice(index, 1);
                this.updateChecklist(checklist);
            }
        },

        async updateChecklist(instance) {
            const index = this.checklists.findIndex((v) => v.id === instance.id);

            if (index >= 0) {
                const newValue = await TaskList.update(instance);
                this.checklists.splice(index, 1, newValue);
            }
        }
    },

    watch: {
        $route: {
            immediate: true,
            handler(to) {
                if (typeof to.params.date === 'undefined') {
                    return this.jumpTo(new Date);
                }

                this.$nextTick(async () => {
                    this.checklists = await TaskList.get(to.params.date);
                });
            }
        }
    }
}
</script>
