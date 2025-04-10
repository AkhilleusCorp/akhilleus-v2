class WorkoutDTO {
    id: number;
    name: string;
    status: string;
    visibility: string;
    duration: string|null;
    startDate: string|null;
    endDate: string|null;
    plannedDate: string|null;

    constructor(
        id: number,
        name: string,
        status: string,
        visibility: string,
        duration: string|null,
        startDate: string|null,
        endDate: string|null,
        plannedDate: string|null,
    ) {
        this.id = id;
        this.name = name;
        this.status = status;
        this.visibility = visibility;
        this.duration = duration;
        this.startDate = startDate;
        this.endDate = endDate;
        this.plannedDate = plannedDate;
    }

}

export default WorkoutDTO;