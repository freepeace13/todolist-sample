import axios from 'axios';

export default class Task {
    constructor(props) {
        this.id = props.id;
        this.title = props.title;
        this.groupId = props.groupId;
        this.completed = props.completed;
        this.createdAt = props.createdAt;
    }

    recreate(props = {}) {
        return new Task({ ...this, ...props });
    }

    static async create(group) {
        const { data } = await axios.post(`/api/groups/${group.id}/tasks`);
        return new Task(data.data);
    }

    static async update(task) {
        const { data } = await axios.patch(`/api/groups/${task.groupId}/tasks/${task.id}`, {
            title: task.title,
            completed: task.completed
        });

        return new Task(data.data);
    }

    static async destroy(task) {
        return await axios.delete(`/api/groups/${task.groupId}/tasks/${task.id}`);
    }
}
