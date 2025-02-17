import ExerciseDTO from "app/common/services/api/dtos/ExerciseDTO.tsx";
import MovementConfigsDTO from "app/common/services/api/dtos/MovementConfigsDTO.tsx";

class ExerciseGroupDTO {
    id: number;
    workoutId: number;
    movementConfigs: MovementConfigsDTO;
    exercises: ExerciseDTO[];

    constructor(
        id: number,
        workoutId: number,
        movementConfigs: MovementConfigsDTO,
        exercises: ExerciseDTO[]
    ) {
        this.id = id;
        this.workoutId = workoutId;
        this.movementConfigs = movementConfigs;
        this.exercises = exercises;
    }
}

export default ExerciseGroupDTO;