class PaginationDTO {
    count: number;
    firstPage: number;
    currentPage: number;
    lastPage: number;

    constructor(
        count: number,
        firstPage: number,
        currentPage: number,
        lastPage: number,
    ) {
        this.count = count;
        this.firstPage = firstPage;
        this.currentPage = currentPage;
        this.lastPage = lastPage;
    }
}

export default PaginationDTO;