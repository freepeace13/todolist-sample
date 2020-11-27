<template lang="pug">
    div
        v-navigator(:date="$route.params.date")

        v-weekdays(:date="$route.params.date")

        div.bg-white.py-2.text-center
            button.btn.btn-light(@click="createGroup") ADD GROUP

        .bg-light.py-5.overflow-auto(style={ height: 'calc(100vh - 217px)' })
            .container-fluid.h-100
                .row.flex-nowrap.h-100
                    .col-xl-3.col-lg-4.col-sm-6.col-sm-6.col-12(
                        v-for="(group, index) in groups"
                        :key="group.id"
                    )
                        v-task-group(
                            :value="group"
                            @delete:task="deleteTask(group, $event)"
                            @create:task="createTask(group)"
                        )
</template>

<script>
import moment from 'moment';
import { Group, Task } from '@models';
import vWeekdays from '@components/v-weekdays';
import vNavigator from '@components/v-navigator';
import vTaskGroup from '@components/v-task-group';

export default {
    components: {
        vNavigator,
        vTaskGroup,
        vWeekdays
    },

    data: () => ({
        groups: []
    }),

    provide() {
        return {
            jumpTo: this.jumpTo,
            deleteTask: this.deleteTask,
            createTask: this.createTask,
            updateTask: this.updateTask,
            updateGroup: this.updateGroup,
            deleteGroup: this.deleteGroup,
            createGroup: this.createGroup,
        };
    },

    methods: {
        jumpTo(date) {
            this.$router.replace({
                name: 'tasks',
                params: { date: this.$utils.dates.urldate(date) }
            })
        },

        async updateTask(task) {
            const groupIndex = this.groups.findIndex(
                (v) => v.id === task.groupId
            );

            if (groupIndex !== -1) {
                const group = this.groups[groupIndex];
                const taskIndex = group.tasks.findIndex((v) => v.id === task.id);

                if (taskIndex !== -1) {
                    const result = await Task.update(task);

                    group.tasks.splice(taskIndex, 1, result);

                    this.groups.splice(groupIndex, 1, group);
                }
            }
        },

        async createTask(group) {
            const index = this.groups.findIndex((v) => v.id === group.id);

            if (index >= 0) {
                const result = await Task.create(group);

                group.tasks.push(result);

                this.groups.splice(index, 1, group);
            }
        },

        async deleteTask(task) {
            const index = this.groups.findIndex((v) => v.id === task.groupId);

            if (index !== -1) {
                const group = this.groups[index];
                const taskIndex = group.tasks.findIndex((v) => v.id === task.id);

                if (taskIndex !== -1) {
                    await Task.destroy(task);

                    group.tasks.splice(taskIndex, 1);

                    this.groups.splice(index, 1, group);
                }
            }
        },

        async createGroup() {
            this.groups.push(
                await Group.create(this.$route.params.date)
            );
        },

        async deleteGroup(group) {
            const index = this.groups.findIndex((v) => v.id === group.id);

            if (index !== -1) {
                await Group.destroy(group);

                this.groups.splice(index, 1);
            }
        },

        async updateGroup(group) {
            const index = this.groups.findIndex((v) => v.id === group.id);

            if (index !== -1) {
                const result = await Group.update(group);

                this.groups.splice(index, 1, result);
            }
        }
    },

    watch: {
        $route: {
            immediate: true,
            handler(to) {
                if (! moment(String(to.params.date)).isValid()) {
                    return this.jumpTo(new Date);
                }

                this.$nextTick(async () => {
                    this.groups = await Group.get(to.params.date);
                });
            }
        }
    }
}
</script>
