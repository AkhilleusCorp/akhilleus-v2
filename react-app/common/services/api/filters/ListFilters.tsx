interface ListFilters {
    ids: string[] | null;
    page: number;
    limit: number;
    sorts: string[] | null;
}

export default ListFilters;