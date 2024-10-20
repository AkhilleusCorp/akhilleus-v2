import React, {useState} from "react";
import {FormControl, Grid2 as Grid, SelectChangeEvent, TextField} from "@mui/material";
import UsersListFilters from "app/services/api/filters/UsersListFilters.tsx";
import QueryIds from "app/utils/interfaces/QueryIds.tsx";
import SearchForm from "app/components/form/SearchForm.tsx";
import userRegistries from "app/constants/userRegistries.tsx";
import MultiSelectInput from "app/components/input/MultiSelectInput.tsx";
import SelectInput from "app/components/input/SelectInput.tsx";

type UserSearchFormType = {
    defaultFilters: UsersListFilters,
    callbackFunction: (filters: UsersListFilters) => void;
}

const UsersSearchForm: React.FC<UserSearchFormType> = ({defaultFilters, callbackFunction}) => {
    const [filters, setFilters] = useState<UsersListFilters>(defaultFilters);

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement | HTMLSelectElement | HTMLTextAreaElement>) => {
        setFilters({
            ...filters,
            [event.target.name]: event.target.value
        });
    }

    const handleSelectChange = (event: SelectChangeEvent<QueryIds>|SelectChangeEvent) => {
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
                        <TextField id="outlined-basic" label="Username" variant="outlined" size="small"
                                   name={"username"} value={filters.username ?? ''} onChange={handleInputChange}/>
                </FormControl>
                <FormControl fullWidth>
                        <TextField id="outlined-basic" label="Email" variant="outlined" size="small"
                                   name={"email"} value={filters.email ?? ''} onChange={handleInputChange}/>
                </FormControl>
            </Grid>
            <Grid size={{ xs: 4 }}>
                <FormControl fullWidth>
                    <SelectInput label={"Type"} name={"type"} value={filters.type} options={userRegistries.type}
                                 onSelectChange={handleSelectChange} required={false}/>
                </FormControl>
                <MultiSelectInput label={"Status"} name={"status"} value={filters.status}
                                  options={userRegistries.status}
                                  onSelectChange={handleSelectChange} required={false}/>
            </Grid>
        </SearchForm>
    )
}

export default UsersSearchForm;