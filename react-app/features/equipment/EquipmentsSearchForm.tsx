import React, {useState} from "react";
import EquipmentsListFilters from "../../services/api/filters/EquipmentsListFilters.tsx";
import SearchForm from "../../components/form/SearchForm.tsx";
import {FormControl, Grid2 as Grid, TextField} from "@mui/material";

type EquipmentSearchFormType = {
    defaultFilters: EquipmentsListFilters,
    callbackFunction: (filters: EquipmentsListFilters) => void;
}

const EquipmentsSearchForm: React.FC<EquipmentSearchFormType> = ({defaultFilters, callbackFunction}) => {
    const [filters, setFilters] = useState<EquipmentsListFilters>(defaultFilters);

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

export default EquipmentsSearchForm;