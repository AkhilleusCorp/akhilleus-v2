import MovementDTO from "app/admin/services/api/dtos/MovementDTO.tsx";

class MovementUpdateSource {
    id: number;
    name: string;
    status: string;
    primaryMuscle: number;
    auxiliaryMuscles: number[];
    equipments: number[];

    constructor(movement: MovementDTO)
    {
        this.id = movement.id;
        this.name = movement.name;
        this.status = movement.status;
        this.primaryMuscle = movement.primaryMuscle.id;
        this.auxiliaryMuscles = movement.auxiliaryMuscles.map((muscle) => { return muscle.id });
        this.equipments = movement.equipments.map((equipment) => { return equipment.id });
    }
}

export default MovementUpdateSource;