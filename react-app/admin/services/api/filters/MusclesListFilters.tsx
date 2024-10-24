import ListFilters from "app/common/services/api/filters/ListFilters.tsx";

class MuscleListFilters implements ListFilters {
    ids: string[] | null;
    page: number;
    limit: number;
    sorts: string[] | null;

    name: string | null;
    status: string[] | null;

    constructor() {
        this.ids = null;
        this.page = 1;
        this.limit =  25;
        this.sorts = ['name'];

        this.name = null;
        this.status = ['active'];
    }
}

export default MuscleListFilters;