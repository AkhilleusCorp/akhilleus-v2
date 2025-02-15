import MovementDTO from "app/common/services/api/dtos/MovementDTO.tsx";

class MovementUpdateSource {
    id: number;
    name: string;
    status: string;
    hasReps: boolean;
    hasWeight: boolean;
    hasDuration: boolean;
    hasDistance: boolean;
    hasSpeed: boolean;
    primaryMuscle: number;
    auxiliaryMuscles: number[];
    equipments: number[];

    constructor(movement: MovementDTO)
    {
        this.id = movement.id;
        this.name = movement.name;
        this.status = movement.status;
        this.hasReps = movement.hasReps;
        this.hasWeight = movement.hasWeight;
        this.hasDuration = movement.hasDuration;
        this.hasDistance = movement.hasDistance;
        this.hasSpeed = movement.hasSpeed;
        this.primaryMuscle = movement.primaryMuscle.id;
        this.auxiliaryMuscles = movement.auxiliaryMuscles.map((muscle) => { return muscle.id });
        this.equipments = movement.equipments.map((equipment) => { return equipment.id });
    }
}

export default MovementUpdateSource;