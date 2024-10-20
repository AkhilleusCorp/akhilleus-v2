import React, {useState} from "react";
import {FormControl, Grid2 as Grid, SelectChangeEvent, TextField} from "@mui/material";
import EquipmentsListFilters from "app/services/api/filters/EquipmentsListFilters.tsx";
import QueryIds from "app/utils/interfaces/QueryIds.tsx";
import SearchForm from "app/components/form/SearchForm.tsx";
import MultiSelectInput from "app/components/input/MultiSelectInput.tsx";
import equipmentRegistries from "app/constants/equipmentRegistries.tsx";

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

    const handleSelectChange = (event: SelectChangeEvent<QueryIds>) => {
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
            <Grid size={{ xs: 4 }}>
                <MultiSelectInput label={"Status"} name={"status"} value={filters.status}
                                  options={equipmentRegistries.status}
                                  onSelectChange={handleSelectChange} required={false}/>
            </Grid>
        </SearchForm>
    )
}

export default EquipmentsSearchForm;