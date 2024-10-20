class MuscleDTO {
    id: number;
    name: string;
    status: string;

    constructor(
        id: number,
        name: string,
        status: string,
    ) {
        this.id = id;
        this.name = name;
        this.status = status;
    }
}

export default MuscleDTO;