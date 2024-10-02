import React from 'react';
import { store } from '../setup/redux';
import AdminLayout from "../layouts/admin/AdminLayout.tsx";
import RepositoriesList from "../widget/RepositoriesList.tsx";
import {Provider} from "react-redux";

const DashboardPage: React.FC = () => {

    return (
        <AdminLayout>
            <h1 className="text-3xl font-bold underline">
                <Provider store={store}>
                    <div>
                        <h2>Search for Package</h2>
                        <RepositoriesList />
                    </div>
                </Provider>
            </h1>
        </AdminLayout>
    );
}

export default DashboardPage;