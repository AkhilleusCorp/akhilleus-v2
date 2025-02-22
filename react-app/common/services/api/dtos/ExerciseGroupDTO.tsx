import ExerciseDTO from "app/common/services/api/dtos/ExerciseDTO.tsx";
import MovementConfigsDTO from "app/common/services/api/dtos/MovementConfigsDTO.tsx";

class ExerciseGroupDTO {
    id: number;
    restDuration: number;
    workoutId: number;
    movementConfigs: MovementConfigsDTO;
    exercises: ExerciseDTO[];

    constructor(
        id: number,
        restDuration: number,
        workoutId: number,
        movementConfigs: MovementConfigsDTO,
        exercises: ExerciseDTO[]
    ) {
        this.id = id;
        this.restDuration = restDuration;
        this.workoutId = workoutId;
        this.movementConfigs = movementConfigs;
        this.exercises = exercises;
    }
}

export default ExerciseGroupDTO;