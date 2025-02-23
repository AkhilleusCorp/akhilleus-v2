class ExerciseGroupSource {
    movementIds: number[];
    restDuration: null|number;

    constructor(
        movementIds: number[],
        restDuration: null|number
    ) {
        this.movementIds = movementIds;
        this.restDuration = restDuration;
    }
}

export default ExerciseGroupSource;