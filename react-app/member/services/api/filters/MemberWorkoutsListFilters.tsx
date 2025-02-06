
import ListFilters from "app/common/services/api/filters/ListFilters.tsx";

class MemberWorkoutsListFilters implements ListFilters {
    ids: string[] | null;
    page: number;
    limit: number;
    sorts: string[] | null;
    status: string[] | null;

    constructor(
        limit?: number
    ) {
        this.ids = null;
        this.page = 1;
        this.limit = limit ?? 25;
        this.sorts = null;

        this.status = null;
    }
}

export default MemberWorkoutsListFilters;