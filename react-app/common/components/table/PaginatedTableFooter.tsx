import {Grid2 as Grid, Pagination, Typography} from "@mui/material";
import React from "react";
import ListFilters from "app/common/services/api/filters/ListFilters.tsx";
import PaginationDTO from "app/common/services/api/dtos/PaginationDTO.tsx";

type PaginatedTableFooter = {
    pagination: PaginationDTO | null,
    filters: ListFilters,
    callbackFunction: (filters: ListFilters) => void,
}

const PaginatedTableFooter: React.FC<PaginatedTableFooter> = ({pagination, filters, callbackFunction}) => {
    if (null == pagination) {
        return <></>
    }

    const handlePageChange = (event: React.ChangeEvent<unknown>, page: number) => {
        event?.preventDefault();

        filters.page = page;
        callbackFunction(filters);
    }

    const from: number = ((pagination.currentPage - 1) * filters.limit) + 1;
    const to: number = pagination.currentPage * filters.limit;

    return (
        <Grid container spacing={2} className={"margin-top-s margin-bottom-s"}>
            <Grid size="grow">
                <Typography gutterBottom variant="h5" component="div">
                    {from} - {to > pagination.count ? pagination.count : to} out of {pagination.count}
                </Typography>
            </Grid>
            <Grid size="auto">
                <Pagination count={pagination.lastPage} page={pagination.currentPage} onChange={handlePageChange} />
            </Grid>
        </Grid>
    );
}

export default PaginatedTableFooter;