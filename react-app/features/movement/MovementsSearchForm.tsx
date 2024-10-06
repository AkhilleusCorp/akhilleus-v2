import React, {useState} from "react";
import MovementsListFilters from "../../services/api/filters/MovementsListFilters.tsx";
import SearchForm from "../../components/form/SearchForm.tsx";
import {FormControl, Grid2 as Grid, TextField} from "@mui/material";

type MovementSearchFormType = {
    defaultFilters: MovementsListFilters,
    callbackFunction: (filters: MovementsListFilters) => void;
}

const MovementsSearchForm: React.FC<MovementSearchFormType> = ({defaultFilters, callbackFunction}) => {
    const [filters, setFilters] = useState<MovementsListFilters>(defaultFilters);

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
                               name={"ids"} value={filters.ids ?? ''} onChange={handleInputChange}/>
                </FormControl>
                <FormControl fullWidth>
                    <TextField id="outlined-basic" label="name" variant="outlined" size="small"
                               name={"name"} value={filters.name ?? ''} onChange={handleInputChange}/>
                </FormControl>
            </Grid>
            <Grid size={{ xs: 4 }}>
                <FormControl fullWidth>
                    <TextField id="outlined-basic" label="Muscle" variant="outlined" size="small"
                               name={"muscleId"} value={filters.muscleId ?? ''} onChange={handleInputChange}/>
                </FormControl>
                <FormControl fullWidth>
                    <TextField id="outlined-basic" label="Equipment" variant="outlined" size="small"
                               name={"equipmentId"} value={filters.equipmentId ?? ''} onChange={handleInputChange}/>
                </FormControl>
            </Grid>
        </SearchForm>
)
}

export default MovementsSearchForm;