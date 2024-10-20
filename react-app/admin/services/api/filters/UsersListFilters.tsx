import ListFilters from "app/common/services/api/filters/ListFilters.tsx";

class UsersListFilters implements ListFilters {
    ids: string[] | null;
    page: number;
    limit: number;
    sorts: string[] | null;

    username: string | null;
    email: string | null;
    status: string[] | null;
    type: string | null;

    constructor() {
        this.ids = null;
        this.page = 1;
        this.limit =  25;
        this.sorts = null;

        this.username = null;
        this.email = null;
        this.status = null;
        this.type = null;
    }
}

export default UsersListFilters;