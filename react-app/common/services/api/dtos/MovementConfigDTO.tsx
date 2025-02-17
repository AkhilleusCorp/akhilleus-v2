import MovementPropertyDTO from "app/common/services/api/dtos/MovementPropertyDTO.tsx";

class MovementConfigDTO {
    name: string;
    trackedProperties: MovementPropertyDTO[];

    constructor(
        name: string,
        trackedProperties: MovementPropertyDTO[],
    ) {
        this.name = name;
        this.trackedProperties = trackedProperties;
    }
}

export default MovementConfigDTO;