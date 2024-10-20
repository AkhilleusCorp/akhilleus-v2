import React, {useState} from "react";
import {FormControl, Grid2 as Grid, SelectChangeEvent, TextField} from "@mui/material";
import MusclesListFilters from "app/services/api/filters/MusclesListFilters.tsx";
import QueryIds from "app/utils/interfaces/QueryIds.tsx";
import muscleRegistries from "app/constants/muscleRegistries.tsx";
import MultiSelectInput from "app/components/input/MultiSelectInput.tsx";
import SearchForm from "app/components/form/SearchForm.tsx";

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
                                  options={muscleRegistries.status}
                                  onSelectChange={handleSelectChange} required={false}/>
            </Grid>
        </SearchForm>
    )
}

export default MusclesSearchForm;