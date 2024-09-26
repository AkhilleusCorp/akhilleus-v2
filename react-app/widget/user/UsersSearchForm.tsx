import React, {useState} from "react";
import UsersListFilters from "../../filters/UsersListFilters.tsx";
import SearchForm from "../common/form/SearchForm.tsx";

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
                    <label>IDs</label>
                    <input type={"text"} name={"ids"} value={filters.ids ?? ''} onChange={handleInputChange}/>
                </div>
                <div>
                    <label>Username</label>
                    <input type={"text"} name={"username"} value={filters.username ?? ''} onChange={handleInputChange}/>
                </div>
                <div>
                    <label>Email</label>
                    <input type={"text"} name={"email"} value={filters.email ?? ''} onChange={handleInputChange}/>
                </div>
            </div>
            <div className={"column"}>
                <div>
                    <label>Statuses</label>
                    <input type={"text"} name={"statuses"} value={filters.statuses ?? ''} onChange={handleInputChange}/>
                </div>
                <div>
                    <label>Types</label>
                    <input type={"text"} name={"types"} value={filters.types ?? ''} onChange={handleInputChange}/>
                </div>
            </div>
        </SearchForm>
    )
}

export default UsersSearchForm;