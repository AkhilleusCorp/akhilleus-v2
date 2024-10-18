class APIResponseDTO {
    data: [];
    extra: any;

    constructor(
        data: [],
        extra: any,
    ) {
        this.data = data;
        this.extra = extra;
    }
}

export default APIResponseDTO;