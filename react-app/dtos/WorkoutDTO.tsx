class WorkoutDTO {
    id: number;
    name: string;
    status: string;
    visibility: string;

    constructor(
        id: number,
        name: string,
        status: string,
        visibility: string,
    ) {
        this.id = id;
        this.name = name;
        this.status = status;
        this.visibility = visibility;
    }

}

export default WorkoutDTO;