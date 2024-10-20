import * as ReactDOM from "react-dom/client";
import {Provider} from "react-redux";
import {StrictMode} from "react";
import AdminRouter from "app/admin/services/router/AdminRouter.tsx";
import {store} from "app/admin/services/redux";

const root = document.getElementById("root")!;
ReactDOM.createRoot(root).render(
    <StrictMode>
        <Provider store={store}>
            <AdminRouter />
        </Provider>
    </StrictMode>
);
