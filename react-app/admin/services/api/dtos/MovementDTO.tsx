import SimpleEmbeddedDTO from "app/common/services/api/dtos/SimpleEmbeddedDTO.tsx";

class MovementDTO {
    id: number;
    name: string;
    status: string;
    primaryMuscle: SimpleEmbeddedDTO;
    auxiliaryMuscles: SimpleEmbeddedDTO[];
    equipments: SimpleEmbeddedDTO[];

    constructor(
        id: number,
        name: string,
        status: string,
        primaryMuscle: SimpleEmbeddedDTO,
        auxiliaryMuscles: SimpleEmbeddedDTO[],
        equipments: SimpleEmbeddedDTO[]
    ) {
        this.id = id;
        this.name = name;
        this.status = status;
        this.primaryMuscle = primaryMuscle;
        this.auxiliaryMuscles = auxiliaryMuscles;
        this.equipments = equipments;
    }
}

export default MovementDTO;