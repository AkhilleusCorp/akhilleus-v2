import SimpleEmbeddedDTO from "./SimpleEmbeddedDTO.tsx";

class MovementDTO {
    id: number;
    name: string;
    primaryMuscle: SimpleEmbeddedDTO;
    auxiliaryMuscles: SimpleEmbeddedDTO[];
    equipments: SimpleEmbeddedDTO[];

    constructor(
        id: number,
        name: string,
        primaryMuscle: SimpleEmbeddedDTO,
        auxiliaryMuscles: SimpleEmbeddedDTO[],
        equipments: SimpleEmbeddedDTO[]
    ) {
        this.id = id;
        this.name = name;
        this.primaryMuscle = primaryMuscle;
        this.auxiliaryMuscles = auxiliaryMuscles;
        this.equipments = equipments;
    }
}

export default MovementDTO;