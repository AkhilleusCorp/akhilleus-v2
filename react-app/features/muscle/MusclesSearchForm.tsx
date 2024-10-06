import React, {useState} from "react";
import MusclesListFilters from "../../services/api/filters/MusclesListFilters.tsx";
import SearchForm from "../../components/form/SearchForm.tsx";
import {FormControl, Grid2 as Grid, TextField} from "@mui/material";

type MuscleSearchFormType = {
    defaultFilters: MusclesListFilters,
    callbackFunction: (filters: MusclesListFilters) => void;
}

const MusclesSearchForm: React.FC<MuscleSearchFormType> = ({defaultFilters, callbackFunction}) => {
    const [filters, setFilters] = useState<MusclesListFilters>(defaultFilters);

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setFilters({
            ...filters,
            [event.target.name]: event.target.value
        });
    }

    return (
        <SearchForm searchFunction={callbackFunction} filters={filters}>
            <Grid size={{ xs: 4 }}>
                <FormControl fullWidth>
                    <TextField id="outlined-basic" label="IDs" variant="outlined" size="small"
                               name={"ids"} value={filters.ids ?? ''} onChange={handleInputChange} />
                </FormControl>
                <FormControl fullWidth>
                    <TextField id="outlined-basic" label="name" variant="outlined" size="small"
                               name={"name"} value={filters.name ?? ''} onChange={handleInputChange} />
                </FormControl>
            </Grid>
        </SearchForm>
    )
}

export default MusclesSearchForm;