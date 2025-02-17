class MovementPropertyDTO {
    name: string;
    unit: null|string;

    constructor(
        name: string,
        unit: null|string,
    ) {
        this.name = name;
        this.unit = unit;
    }
}

export default MovementPropertyDTO;