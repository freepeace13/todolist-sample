import axios from 'axios';

export default class Task {
    constructor(props) {
        this.id = props.id;
        this.title = props.title;
        this.completed = props.completed;
        this.createdAt = props.createdAt;
    }

    recreate(props = {}) {
        return new Task({ ...this, ...props });
    }

    static async create(listId) {
        const { data } = await axios.post(`/api/tasks`, { listId });
        return new Task(data.data);
    }
}
