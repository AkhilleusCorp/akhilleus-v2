class ExerciseDTO {
    id: number;
    movementId: number;
    movementName: string;

    constructor(
        id: number,
        movementId: number,
        movementName: string
    ) {
        this.id = id;
        this.movementId = movementId;
        this.movementName = movementName;
    }
}

export default ExerciseDTO;