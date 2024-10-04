import React, {useState} from "react";
import UsersListFilters from "../../services/api/filters/UsersListFilters.tsx";
import SearchForm from "../../components/form/SearchForm.tsx";
import {SelectChangeEvent, TextField} from "@mui/material";
import DropdownInput from "../../components/input/DropdownInput.tsx";
import userRegistries from "../../constants/userRegistries.tsx";

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

    const handleSelectChange = (event: SelectChangeEvent) => {
        setFilters({
            ...filters,
            [event.target.name]: event.target.value
        });
    }

    const handleCancel = () => {
        // Why is it needed for User search form and not for Workout search form ?
        defaultFilters.ids = null;
        defaultFilters.username = null;
        defaultFilters.email = null;
        defaultFilters.status = null;
        defaultFilters.type = null;

        setFilters(defaultFilters);
        callbackFunction(defaultFilters);
    }

    return (
        <SearchForm searchFunction={callbackFunction} cancelFunction={handleCancel} filters={filters}>
                <div>
                    <TextField id="outlined-basic" label="IDs" variant="outlined" size="small"
                               name={"ids"} value={filters.ids ?? ''} onChange={handleInputChange} />
                </div>
                <div>
                    <TextField id="outlined-basic" label="Username" variant="outlined" size="small"
                               name={"username"} value={filters.username ?? ''} onChange={handleInputChange} />
                </div>
                <div>
                    <TextField id="outlined-basic" label="Email" variant="outlined" size="small"
                               name={"email"} value={filters.email ?? ''} onChange={handleInputChange} />
                </div>
                <div>
                    <DropdownInput label={"Type"} name={"type"} value={filters.type} options={userRegistries.type}
                                   onSelectChange={handleSelectChange} required={false}/>
                </div>
                <div>
                    <DropdownInput label={"Status"} name={"status"} value={filters.status}
                                   options={userRegistries.status}
                                   onSelectChange={handleSelectChange} required={false}/>
                </div>
        </SearchForm>
    )
}

export default UsersSearchForm;