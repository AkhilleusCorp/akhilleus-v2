
class ExerciseDTO {
    id: number;
    movementId: number;

    constructor(
        id: number,
        movementId: number,
    ) {
        this.id = id;
        this.movementId = movementId;
    }
}

export default ExerciseDTO;