import SimpleEmbeddedDTO from "app/common/services/api/dtos/SimpleEmbeddedDTO.tsx";

class MovementDTO {
    id: number;
    name: string;
    status: string;
    hasReps: boolean;
    hasWeight: boolean;
    hasDuration: boolean;
    hasDistance: boolean;
    hasSpeed: boolean;
    primaryMuscle: SimpleEmbeddedDTO;
    auxiliaryMuscles: SimpleEmbeddedDTO[];
    equipments: SimpleEmbeddedDTO[];

    constructor(
        id: number,
        name: string,
        status: string,
        hasReps: boolean,
        hasWeight: boolean,
        hasDuration: boolean,
        hasDistance: boolean,
        hasSpeed: boolean,
        primaryMuscle: SimpleEmbeddedDTO,
        auxiliaryMuscles: SimpleEmbeddedDTO[],
        equipments: SimpleEmbeddedDTO[]
    ) {
        this.id = id;
        this.name = name;
        this.status = status;
        this.hasReps = hasReps;
        this.hasWeight = hasWeight;
        this.hasDuration = hasDuration;
        this.hasDistance = hasDistance;
        this.hasSpeed = hasSpeed;
        this.primaryMuscle = primaryMuscle;
        this.auxiliaryMuscles = auxiliaryMuscles;
        this.equipments = equipments;
    }
}

export default MovementDTO;