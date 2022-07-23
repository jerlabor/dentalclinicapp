import { Model as BaseModel } from 'vue-api-query'
import { values, filter, isEmpty } from 'lodash'
// import { serialize } from 'object-to-formdata'



export default class Model extends BaseModel {
    baseURL() {
        return '/api/v1'
    }

    // implement a default request method
    async request(config) {
        if (config.data instanceof FormData) {
            if (config.data.get('http_method') === 'put') {
                config.method = 'POST'
                config.data.append('_method', 'PUT')
                config.data.delete('http_method')
            }
        }

        const hasUpload = !isEmpty(
            filter(values(config.data), value => {
                return value instanceof File
            })
        )

        if (hasUpload && config.method !== 'PUT') {
            config.data = serialize(config.data, { indices: true })
        }

        return this.$http.request(config)
    }
}
