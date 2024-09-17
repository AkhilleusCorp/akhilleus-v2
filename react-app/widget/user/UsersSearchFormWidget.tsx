import React, {useState} from "react";
import UsersListFilters from "../../filters/UsersListFilters.tsx";

type UsersSearchFormWidgetProps = {
    defaultFilters: UsersListFilters,
    callbackFunction: (filters: UsersListFilters) => void;
}

const UsersSearchFormWidget: React.FC<UsersSearchFormWidgetProps> = ({defaultFilters, callbackFunction}) => {
    const [filters, setFilters] = useState<UsersListFilters>(defaultFilters);

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setFilters({
            ...filters,
            [event.target.name]: event.target.value
        });
    }

    const handleClick = () => {
        console.log(filters);
        callbackFunction(filters);
    }

    return (
        <div>
            <div>
                <input type={"text"} name={"login"} onChange={handleInputChange}/>
            </div>
            <div>
                <input type={"text"} name={"email"} onChange={handleInputChange}/>
            </div>

            <button onClick={handleClick}>Search</button>
        </div>
    )
}

export default UsersSearchFormWidget;