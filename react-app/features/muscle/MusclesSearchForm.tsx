import React, {useState} from "react";
import MusclesListFilters from "../../services/api/filters/MusclesListFilters.tsx";
import SearchForm from "../../components/form/SearchForm.tsx";
import {FormControl, Grid2 as Grid, SelectChangeEvent, TextField} from "@mui/material";
import MultiSelectInput from "../../components/input/MultiSelectInput.tsx";
import muscleRegistries from "../../constants/muscleRegistries.tsx";

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

    const handleSelectChange = (event: SelectChangeEvent<string[]>) => {
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