import ListFilters from "app/common/services/api/filters/ListFilters.tsx";

class MovementsListFilters implements ListFilters {
    ids: string[] | null;
    page: number;
    limit: number;
    sorts: string[] | null;

    name: string | null;
    status: string[];
    muscleId: string | null;
    equipmentId: string | null;

    constructor() {
        this.ids = null;
        this.page = 1;
        this.limit =  25;
        this.sorts = ['name'];

        this.name = null;
        this.status = ['active'];
        this.muscleId = null;
        this.equipmentId = null;
    }
}

export default MovementsListFilters;