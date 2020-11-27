import axios from 'axios';
import Task from './task';

export default class Group {
    constructor(props) {
        this.id = props.id;
        this.schedule = props.schedule;
        this.title = props.title;
        this.tasks = props.tasks.map((v) => new Task(v));
        this.completed = props.completed;
        this.createdAt = props.createdAt;
    }

    recreate(props = {}) {
        return new Group({ ...this, ...props });
    }

    static async get(date) {
        const { data: { data } } = await axios.get(`/api/groups/${date}`);
        return data.map((v) => new Group(v));
    }

    static async create(date) {
        const { data: { data } } = await axios.post(`/api/groups/${date}`);
        return new Group(data);
    }

    static async update(group) {
        const { data } = await axios.patch(`/api/groups/${group.id}`, {
            title: group.title
        });

        return new Group(data.data);
    }

    static async destroy(group) {
        return await axios.delete(`/api/groups/${group.id}`);
    }
}
