import ExerciseDTO from "./ExerciseDTO.tsx";

class ExerciseGroupDTO {
    id: number;
    workoutId: number;
    movementIds: string[];
    exercises: ExerciseDTO[];

    constructor(
        id: number,
        workoutId: number,
        movementIds: string[],
        exercises: ExerciseDTO[]
    ) {
        this.id = id;
        this.workoutId = workoutId;
        this.movementIds = movementIds;
        this.exercises = exercises;
    }
}

export default ExerciseGroupDTO;