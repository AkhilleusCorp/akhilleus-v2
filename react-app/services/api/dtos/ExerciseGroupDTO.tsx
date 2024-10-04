import ExerciseDTO from "./ExerciseDTO.tsx";

class ExerciseGroupDTO {
    id: number;
    movementIds: string[];
    exercises: ExerciseDTO[];

    constructor(
        id: number,
        movementIds: string[],
        exercises: ExerciseDTO[]
    ) {
        this.id = id;
        this.movementIds = movementIds;
        this.exercises = exercises;
    }
}

export default ExerciseGroupDTO;