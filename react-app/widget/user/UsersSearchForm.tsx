import React, {useState} from "react";
import UsersListFilters from "../../filters/UsersListFilters.tsx";
import SearchForm from "../common/form/SearchForm.tsx";
import {TextField} from "@mui/material";

type UserSearchFormType = {
    defaultFilters: UsersListFilters,
    callbackFunction: (filters: UsersListFilters) => void;
}

const UsersSearchForm: React.FC<UserSearchFormType> = ({defaultFilters, callbackFunction}) => {
    const [filters, setFilters] = useState<UsersListFilters>(defaultFilters);

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
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
        defaultFilters.statuses = null;
        defaultFilters.types = null;

        setFilters(defaultFilters);
        callbackFunction(defaultFilters);
    }

    return (
        <SearchForm searchFunction={callbackFunction} cancelFunction={handleCancel} filters={filters}>
            <div className={"column"}>
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
            </div>
            <div className={"column"}>
                <div>
                    <TextField id="outlined-basic" label="Status" variant="outlined" size="small"
                               name={"statuses"} value={filters.statuses ?? ''} onChange={handleInputChange} />
                </div>
                <div>
                    <TextField id="outlined-basic" label="Type" variant="outlined" size="small"
                               name={"types"} value={filters.types ?? ''} onChange={handleInputChange} />
                </div>
            </div>
        </SearchForm>
    )
}

export default UsersSearchForm;