import axios from 'axios';
import Task from './task';

export default class TaskList {
    constructor(props) {
        this.id = props.id;
        this.schedule = props.schedule;
        this.title = props.title;
        this.tasks = props.tasks.map((v) => new Task(v));
        this.completed = true;
        this.createdAt = props.createdAt;
    }

    spliceTask(task) {
        const index = this.tasks.findIndex((v) => v.id === task.id);
        const cloneTasks = [...this.tasks];

        if (index >= 0) {
            cloneTasks.splice(index, 1, task);
        }

        return this.recreate({ tasks: cloneTasks });
    }

    recreate(props = {}) {
        return new TaskList({ ...this, ...props });
    }

    static async get(date) {
        const { data: { data } } = await axios.get(`/api/todos/${date}`);
        return data.map((v) => new TaskList(v));
    }

    static async create(date) {
        const { data: { data } } = await axios.post(`/api/todos/${date}`);
        return new TaskList(data);
    }

    static async update(instance) {
        const { data } = await axios.patch(`/api/lists/${instance.id}`, {
            title: instance.title,
            tasks: instance.tasks.map((v) => ({
                id: v.id,
                title: v.title,
                completed: v.completed
            }))
        });

        return new TaskList(data.data);
    }

    static async destroy(listId) {
        return await axios.delete(`/api/lists/${listId}`);
    }
}
